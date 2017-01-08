<?php
/*
 * Copyright 2015 Florian "Bluewind" Pritz <bluewind@server-speed.net>
 *
 * Licensed under AGPLv3
 * (see COPYING for full license text)
 *
 */

namespace test\tests;

class test_libraries_pygments extends \test\Test {

	public function __construct()
	{
		parent::__construct();
	}

	public function init()
	{
	}

	public function cleanup()
	{
	}

	public function test_autodetect_lexer_normalCase()
    {
		$p = new \libraries\Pygments('/invalid/filepath', 'text/plain', 'stdin');
        $this->t->is($p->autodetect_lexer(), 'text', "text/plain should be text");

		$p = new \libraries\Pygments('/invalid/filepath', 'application/x-php', 'stdin');
		$this->t->is($p->autodetect_lexer(), 'php', "application/php should be php");

		// This is from pygments and not our hardcoded list
		$p = new \libraries\Pygments('/invalid/filepath', 'text/x-pascal', 'stdin');
		$this->t->is($p->autodetect_lexer(), 'delphi', "text/x-pascal should be delphi");

		$p = new \libraries\Pygments('/invalid/filepath', 'application/octet-stream', 'stdin');
		$this->t->is($p->autodetect_lexer(), false, "application/octet-stream should return false");
    }

	public function test_autodetect_lexer_specialFilenames()
    {
		$p = new \libraries\Pygments('/invalid/filepath', 'text/plain', 'foo.c');
        $this->t->is($p->autodetect_lexer(), 'c', "foo.c should be c");

		$p = new \libraries\Pygments('/invalid/filepath', 'text/plain', 'PKGBUILD');
        $this->t->is($p->autodetect_lexer(), 'bash', "PKGBUILD should be bash");

		$p = new \libraries\Pygments('/invalid/filepath', 'text/plain', 'asciinema.json');
        $this->t->is($p->autodetect_lexer(), 'asciinema', "asciinema.json should be asciinema");

		$p = new \libraries\Pygments('/invalid/filepath', 'text/plain', 'test.asciinema.json');
        $this->t->is($p->autodetect_lexer(), 'asciinema', "asciinema.json should be asciinema");
    }

	public function test_autodetect_lexer_specialFilenamesBinaryShouldNotHighlight()
    {
		$p = new \libraries\Pygments('/invalid/filepath', 'application/octet-stream', 'foo.c');
        $this->t->is($p->autodetect_lexer(), false, "foo.c should not highlight if binary");

		$p = new \libraries\Pygments('/invalid/filepath', 'application/octet-stream', 'PKGBUILD');
        $this->t->is($p->autodetect_lexer(), false, "PKGBUILD should not highlight if binary");
    }

	public function test_can_highlight_normalCase()
    {
		$p = new \libraries\Pygments('/invalid/filepath', 'text/plain', 'stdin');
        $this->t->is($p->can_highlight(), true, "text/plain can highlight");

		$p = new \libraries\Pygments('/invalid/filepath', 'application/x-php', 'stdin');
        $this->t->is($p->can_highlight(), true, "application/x-php can highlight");

		$p = new \libraries\Pygments('/invalid/filepath', 'application/octet-stream', 'stdin');
        $this->t->is($p->can_highlight(), false, "application/octet-stream can not highlight");
	}

	public function test_autodetect_lexer_canButShouldntHighlight()
    {
		$p = new \libraries\Pygments('/invalid/filepath', 'image/svg+xml', 'foo.svg');
        $this->t->is($p->autodetect_lexer(), false, "image/svg+xml should return false");
	}

	public function test_can_highlight_canButShouldntHighlight()
    {
		$p = new \libraries\Pygments('/invalid/filepath', 'image/svg+xml', 'foo.svg');
        $this->t->is($p->can_highlight(), true, "image/svg+xml can highlight");
	}

	public function test_autodetect_lexer_strangeFilenames()
	{
		$p = new \libraries\Pygments('/invalid/filepath', 'text/plain', 'foo.');
        $this->t->is($p->autodetect_lexer(), 'text', "foo. should be text");

	}

	public function test_get_lexers()
	{
		$l = \libraries\Pygments::get_lexers();

		$this->t->is($l['text'], 'Plain text', 'Plain text lexer exists');
		$this->t->is($l['c'], 'C', 'C lexer exists');
	}

	public function test_resolve_lexer_alias()
	{
		$p = new \libraries\Pygments('/invalid/filepath', 'text/plain', 'foo.pl');
		$this->t->is($p->resolve_lexer_alias('pl'), 'perl', "Test pl alias for perl");

        $this->t->is($p->resolve_lexer_alias('thisIsInvalid'), 'thisIsInvalid', "Test invalid alias");
	}

}


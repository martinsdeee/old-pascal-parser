<?php

class ParserController extends \BaseController {

    public function index() {
        return View::make('parser.index');
    }

    public function store() {
        $tables = [
            'keywords' => [
                'procedure', 'TObject', 'var',
                'set of char', 'char', 'string',
                'integer', 'begin', 'for', 'to',
                'do', 'if', 'in', 'then', 'else',
                'end'
            ],
            'spliters' => [
                ':=', '.', '(', ')', ':', ';',
                ',', '[', ']', '=', '+',
                '-', '\-', '>', '<', '\''
            ],
            'reg_pattern' => [
                '/:=/', '/\./', '/\(/', '/\)/', '/:/', '/;/',
                '/,/', '/\[/', '/\]/', '/\=/', '/\+/',
                '/\-/', '/>/', '/</', '/\'/'
            ],
            'reg_replacement' => [
                ' := ', ' . ', ' ( ', ' ) ', ' : ', ' ; ',
                ' , ', ' [ ', ' ] ', ' = ', ' + ',
                ' - ', ' > ', ' < ', ' \' '
            ],


            'variables' => [],
            'literals' => [],
        ];
        $tables['raw'] = Input::get('code');

        $pattern = $tables['reg_pattern'];
        $replacement = $tables['reg_replacement'];
        $raw = $tables['raw'];
        // Sagatavo kodu nodzēšos WHITESPACES un sagatavo atdalītājus
        // lai visu var skaisti explodēt pēc SPACE
        $raw = $this->prepare_raw_code($raw, $pattern, $replacement);

        $keywords = $tables['keywords'];
        $spliters = $tables['spliters'];

        $result = $this->return_result_tables($raw, $spliters, $keywords);
        $tables['temp'] = $raw;
        $tables['result'] = $result;
        return View::make('parser.index')
            ->withInput(Input::all())
            ->withTables($tables);
    }

    public function prepare_raw_code($code, $pattern = [], $replacement = []) {
        // Pirms un pēc atdalītājiem saliek atstarpes
        $code = preg_replace($pattern, $replacement, $code);
        // Tiek izdzēsts WHITESPACES(TAB, NEWLINE, RETURN...)
        // un novāktas visas atstarpe kas ir vairāk par vienu
        $code = preg_replace('/\s+/',' ',$code);
        return $code;
    }

    public function return_result_tables($code, $spliters, $keywords) {
        $result = explode(' ', $code);
        return $result;
    }

    // Paterns
    // //
}

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $categoriasVal = [
        'titulo' => 'required|min_length[3]|max_length[10]'
    ];
    public $peliculasVal = [
        'titulo' => 'required|min_length[3]|max_length[10]',
        'descripcion' => 'required|min_length[3]|max_length[20]',
        'categoria_fk' => 'required|is_natural',
    ];

    public $etiquetasVal = [
        'titulo' => 'required|min_length[3]|max_length[10]',
        'categoria_fk' => 'required|is_natural',
    ];

    public $usuariosVal = [
        'usuario' => 'required|min_length[3]|max_length[20]|is_unique[usuarios.usuario]',
        'email' => 'required|min_length[3]|max_length[50]|is_unique[usuarios.email]',
        'contrasena' => 'required|min_length[5]|max_length[15]',

    ];
}

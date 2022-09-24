<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => false,
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'class_definition' => false,
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_align' => false,
        'yoda_style' => false,
        'no_break_comment' => false,
        'no_superfluous_phpdoc_tags' => false,
        'php_unit_fqcn_annotation' => true,
        'no_empty_phpdoc' => true,
        'no_unused_imports' => true,
        'self_accessor' => false,
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => true],
        'phpdoc_trim' => true,
        'phpdoc_separation' => true,
        'fully_qualified_strict_types' => true,
        'phpdoc_single_line_var_spacing' => true,
        'align_multiline_comment' => ['comment_type' => 'all_multiline'],
        'phpdoc_order' => true,
        'declare_strict_types' => true,
        'single_line_throw' => false,
    ])
    ->setFinder($finder);

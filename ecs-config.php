<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrailingCommaInMultilineArrayFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalClassFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer;
use PhpCsFixer\Fixer\Comment\SingleLineCommentStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\LinebreakAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\NoClosingTagFixer;
use PhpCsFixer\Fixer\PhpTag\NoShortEchoTagFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use SlevomatCodingStandard\Sniffs\ControlStructures\AssignmentInConditionSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(MbStrFunctionsFixer::class);

    $services->set(TrailingCommaInMultilineArrayFixer::class);

    $services->set(OrderedClassElementsFixer::class);

    $services->set(ReturnTypeDeclarationFixer::class);

    $services->set(BlankLineAfterNamespaceFixer::class);

    $services->set(SingleBlankLineBeforeNamespaceFixer::class);

    $services->set(DeclareStrictTypesFixer::class);

    $services->set(StrictComparisonFixer::class);

    $services->set(StrictParamFixer::class);

    $services->set(SingleQuoteFixer::class);

    $services->set(FinalClassFixer::class);

    $services->set(AssignmentInConditionSniff::class);

    $services->set(NoSuperfluousPhpdocTagsFixer::class);

    $services->set(ClassAttributesSeparationFixer::class);

    $services->set(PhpdocLineSpanFixer::class);

    $services->set(SingleLineCommentStyleFixer::class)
        ->call('configure', [['comment_types' => ['hash']]]);

    $services->set(BlankLineBeforeStatementFixer::class);

    $services->set(CastSpacesFixer::class);

    $services->set(NoBlankLinesAfterClassOpeningFixer::class);

    $services->set(NoBlankLinesAfterPhpdocFixer::class);

    $services->set(NoEmptyCommentFixer::class);

    $services->set(PhpdocSeparationFixer::class);

    $services->set(NoEmptyStatementFixer::class);

    $services->set(NotOperatorWithSuccessorSpaceFixer::class);

    $services->set(BlankLineAfterOpeningTagFixer::class);

    $services->set(LinebreakAfterOpeningTagFixer::class);

    $services->set(NoClosingTagFixer::class);

    $services->set(NoShortEchoTagFixer::class);

    $services->set(NoExtraBlankLinesFixer::class)
        ->call('configure', [
            [
                'tokens' => [
                    'curly_brace_block',
                    'extra',
                    'parenthesis_brace_block',
                    'square_brace_block',
                    'throw',
                    'use',
                ],
            ],
        ]);

    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::SETS, ['clean-code', 'psr12', 'docblock']);

    $parameters->set(Option::EXCLUDE_PATHS, [
        '.docker-sync/*',
        '.gitlab/*',
        'bootstrap/*',
        'dev/*',
        'node_modules/*',
        'public/*',
        'resources/js/*',
        'resources/sass/*',
        'storage/*',
        'tests/data',
        'vendor/*',
        '.phpstorm.meta.php',
        '.phpunit.result.cache',
        '_ide_helper.php',
        '_ide_helper_models.php',
        'resources/lang/*',
    ]);

    $parameters->set(Option::SKIP, [
        FinalClassFixer::class => [
            'app/Http/Controllers/Controller.php',
        ],
    ]);
};

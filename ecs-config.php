<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalClassFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedTraitsFixer;
use PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer;
use PhpCsFixer\Fixer\Comment\SingleLineCommentStyleFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocLineSpanFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\EchoTagSyntaxFixer;
use PhpCsFixer\Fixer\PhpTag\LinebreakAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\NoClosingTagFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(MbStrFunctionsFixer::class);
    $services->set(TrailingCommaInMultilineFixer::class);
    $services->set(OrderedClassElementsFixer::class);
    $services->set(ReturnTypeDeclarationFixer::class);
    $services->set(VoidReturnFixer::class);
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
    $services->set(SingleTraitInsertPerStatementFixer::class);
    $services->set(OrderedTraitsFixer::class);
    $services->set(VisibilityRequiredFixer::class);
    $services->set(PhpdocLineSpanFixer::class);
    $services->set(SingleLineCommentStyleFixer::class)->call('configure', [['comment_types' => ['hash']]]);
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
    $services->set(EchoTagSyntaxFixer::class);
    $services->set(NoSpacesAfterFunctionNameFixer::class);
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
                    'use_trait'
                ],
            ],
        ]);

    $parameters = $containerConfigurator->parameters();

    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::CLEAN_CODE);
    $containerConfigurator->import(SetList::DOCBLOCK);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

    $parameters->set(Option::SKIP, [
        FinalClassFixer::class => [
            'app/Http/Controllers/Controller.php',
        ],
    ]);
};

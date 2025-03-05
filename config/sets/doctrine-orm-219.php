<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Renaming\Rector\ClassConstFetch\RenameClassConstFetchRector;
use Rector\Renaming\ValueObject\RenameClassAndConstFetch;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([DoctrineSetList::ANNOTATIONS_TO_ATTRIBUTES]);

    $rectorConfig->ruleWithConfiguration(RenameClassConstFetchRector::class, [
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_NONE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_NONE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_INTEGER',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_INTEGER'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_STRING',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_STRING'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_INPUT_PARAMETER',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_INPUT_PARAMETER'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_FLOAT',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_FLOAT'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_CLOSE_PARENTHESIS',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_CLOSE_PARENTHESIS'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_OPEN_PARENTHESIS',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_OPEN_PARENTHESIS'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_COMMA',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_COMMA'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_DIVIDE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_DIVIDE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_DOT',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_DOT'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_EQUALS',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_EQUALS'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_GREATER_THAN',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_GREATER_THAN'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_LOWER_THAN',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_LOWER_THAN'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_MINUS',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_MINUS'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_MULTIPLY',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_MULTIPLY'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_NEGATE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_NEGATE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_PLUS',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_PLUS'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_OPEN_CURLY_BRACE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_OPEN_CURLY_BRACE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_CLOSE_CURLY_BRACE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_CLOSE_CURLY_BRACE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_ALIASED_NAME',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_ALIASED_NAME'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_FULLY_QUALIFIED_NAME',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_FULLY_QUALIFIED_NAME'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_IDENTIFIER',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_IDENTIFIER'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_ALL',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_ALL'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_AND',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_AND'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_ANY',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_ANY'
        ),
        new RenameClassAndConstFetch('Doctrine\\ORM\\Query\\Lexer', 'T_AS', 'Doctrine\\ORM\\Query\\TokenType', 'T_AS'),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_ASC',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_ASC'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_AVG',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_AVG'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_BETWEEN',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_BETWEEN'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_BOTH',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_BOTH'
        ),
        new RenameClassAndConstFetch('Doctrine\\ORM\\Query\\Lexer', 'T_BY', 'Doctrine\\ORM\\Query\\TokenType', 'T_BY'),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_CASE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_CASE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_COALESCE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_COALESCE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_COUNT',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_COUNT'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_DELETE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_DELETE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_DESC',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_DESC'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_DISTINCT',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_DISTINCT'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_ELSE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_ELSE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_EMPTY',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_EMPTY'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_END',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_END'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_ESCAPE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_ESCAPE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_EXISTS',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_EXISTS'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_FALSE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_FALSE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_FROM',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_FROM'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_GROUP',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_GROUP'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_HAVING',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_HAVING'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_HIDDEN',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_HIDDEN'
        ),
        new RenameClassAndConstFetch('Doctrine\\ORM\\Query\\Lexer', 'T_IN', 'Doctrine\\ORM\\Query\\TokenType', 'T_IN'),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_INDEX',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_INDEX'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_INNER',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_INNER'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_INSTANCE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_INSTANCE'
        ),
        new RenameClassAndConstFetch('Doctrine\\ORM\\Query\\Lexer', 'T_IS', 'Doctrine\\ORM\\Query\\TokenType', 'T_IS'),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_JOIN',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_JOIN'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_LEADING',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_LEADING'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_LEFT',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_LEFT'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_LIKE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_LIKE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_MAX',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_MAX'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_MEMBER',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_MEMBER'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_MIN',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_MIN'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_NEW',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_NEW'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_NOT',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_NOT'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_NULL',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_NULL'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_NULLIF',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_NULLIF'
        ),
        new RenameClassAndConstFetch('Doctrine\\ORM\\Query\\Lexer', 'T_OF', 'Doctrine\\ORM\\Query\\TokenType', 'T_OF'),
        new RenameClassAndConstFetch('Doctrine\\ORM\\Query\\Lexer', 'T_OR', 'Doctrine\\ORM\\Query\\TokenType', 'T_OR'),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_ORDER',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_ORDER'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_OUTER',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_OUTER'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_PARTIAL',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_PARTIAL'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_SELECT',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_SELECT'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_SET',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_SET'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_SOME',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_SOME'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_SUM',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_SUM'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_THEN',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_THEN'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_TRAILING',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_TRAILING'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_TRUE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_TRUE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_UPDATE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_UPDATE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_WHEN',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_WHEN'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_WHERE',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_WHERE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\ORM\\Query\\Lexer',
            'T_WITH',
            'Doctrine\\ORM\\Query\\TokenType',
            'T_WITH'
        ),
    ]);
};

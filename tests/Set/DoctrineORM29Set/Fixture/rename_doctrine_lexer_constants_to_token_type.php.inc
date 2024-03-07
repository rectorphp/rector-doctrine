<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class Age extends FunctionNode
{
    private mixed $value1 = null;

    private mixed $value2 = null;

    public function getSql(SqlWalker $sqlWalker)
    {
        if (null !== $this->value2) {
            return sprintf(
                'AGE(%s, %s)',
                $this->value1->dispatch($sqlWalker),
                $this->value2->dispatch($sqlWalker)
            );
        }

        return sprintf(
            'AGE(%s)',
            $this->value1->dispatch($sqlWalker),
        );
    }

    public function parse(Parser $parser)
    {
        $parser->match(\Doctrine\ORM\Query\Lexer::T_IDENTIFIER);
        $parser->match(\Doctrine\ORM\Query\Lexer::T_OPEN_PARENTHESIS);

        $this->value1 = $parser->SimpleArithmeticExpression();

        $parser->match(\Doctrine\ORM\Query\Lexer::T_COMMA);

        $this->value2 = $parser->SimpleArithmeticExpression();

        $parser->match(\Doctrine\ORM\Query\Lexer::T_CLOSE_PARENTHESIS);
    }
}
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class Age extends FunctionNode
{
    private mixed $value1 = null;

    private mixed $value2 = null;

    public function getSql(SqlWalker $sqlWalker)
    {
        if (null !== $this->value2) {
            return sprintf(
                'AGE(%s, %s)',
                $this->value1->dispatch($sqlWalker),
                $this->value2->dispatch($sqlWalker)
            );
        }

        return sprintf(
            'AGE(%s)',
            $this->value1->dispatch($sqlWalker),
        );
    }

    public function parse(Parser $parser)
    {
        $parser->match(\Doctrine\ORM\Query\TokenType::T_IDENTIFIER);
        $parser->match(\Doctrine\ORM\Query\TokenType::T_OPEN_PARENTHESIS);

        $this->value1 = $parser->SimpleArithmeticExpression();

        $parser->match(\Doctrine\ORM\Query\TokenType::T_COMMA);

        $this->value2 = $parser->SimpleArithmeticExpression();

        $parser->match(\Doctrine\ORM\Query\TokenType::T_CLOSE_PARENTHESIS);
    }
}

<?php

use Doctrine\DBAL\Types\DecimalType;
use Doctrine\DBAL\Types\Type;
use My\Project\Types\MoneyType;

Type::addType('money', MoneyType::class);
Type::getType('money');
Type::hasType('money');
Type::overrideType('money', DecimalType::class);
Type::getTypesMap();
Type::getTypeRegistry();

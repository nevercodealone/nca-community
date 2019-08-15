<?php


namespace App\Validator\Constraint;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class BadWords extends Constraint
{
    /**
     * @var array
     */
    public $words;
}

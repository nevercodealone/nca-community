<?php


namespace App\Validator\Constraint;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class BadWordsValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if(!$constraint instanceof BadWords) {
            throw new UnexpectedTypeException($constraint, BadWords::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedValueException($value, 'string');
        }

        $value = mb_strtolower($value);

        foreach ($constraint->words as $badWord) {
            if(strpos($value, mb_strtolower($badWord)) !== false) {
                $this->context->buildViolation('Bitte nicht verwenden: {{ word }}')
                ->setParameter('{{ word }}', $badWord)
                ->addViolation();
            }
        }
    }
}

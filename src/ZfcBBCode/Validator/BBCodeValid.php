<?php


namespace ZfcBBCode\Validator;

use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;
use ZfcBBCode\Service\ParserInterface;

class BBCodeValid extends AbstractValidator
{
    /**
     * Error constants
     */
    const ERROR_IN_VALID = 'InValidText';

    /**
     * @var array Message templates
     */
    protected $messageTemplates = [
        self::ERROR_IN_VALID => "Text is not allowed BBCode"
    ];

    /** @var  ParserInterface */
    protected $bbCodeParser;

    /**
     * BBCodeValid constructor.
     * @param ParserInterface $bbCodeParser
     */
    public function __construct(ParserInterface $bbCodeParser)
    {
        parent::__construct();

        $this->bbCodeParser = $bbCodeParser;
    }

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     *
     * @return bool
     * @throws Exception\RuntimeException If validation of $value is impossible
     */
    public function isValid($value)
    {
        $result = true;
        $this->setValue($value);
        if (!$this->bbCodeParser->isTextValid($value)) {
            $result = false;
            $this->error(self::ERROR_IN_VALID);
        }

        return $result;
    }


}
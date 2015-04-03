<?php


namespace ZfcBBCode\Validator;

use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;
use Zend\ServiceManager\ServiceManager;

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

    /** @var ServiceManager */
    protected $serviceManager;

    /**
     * @param ServiceManager $serviceManager
     */
    public function __construct( ServiceManager $serviceManager )
    {
        $this->setServiceManager( $serviceManager );

        parent::__construct();
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
    public function isValid( $value )
    {
        $result = true;
        $this->setValue( $value );
        if (!$this->getBBCoderParser()->isTextValid( $value )) {
            $result = false;
            $this->error( self::ERROR_IN_VALID );
        }

        return $result;
    }

    /**
     * @param ServiceManager $serviceManager
     *
     * @return $this
     */
    protected function setServiceManager( ServiceManager $serviceManager )
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }

    /**
     * @return ServiceManager
     */
    protected function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @return \ZfcBBCode\Service\ParserInterface
     */
    protected function getBBCoderParser()
    {
        return $this->getServiceManager()->get( 'zfc-bbcode_parser' );
    }
}
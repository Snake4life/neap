<?php
/**
 * Neap (http://neap.io/)
 *
 * @link      http://github.com/e7d/neap for the canonical source repository
 * @copyright Copyright (c) 2015 e7d (http://e7d.io)
 * @license   https://github.com/e7d/neap/blob/master/LICENSE.md The MIT License
 */

namespace Application\Validator;

use Zend\Validator\AbstractValidator;

class UuidV4 extends AbstractValidator
{
    const UUIDV4 = 'uuidv4';

    protected $messageTemplates = array(
        self::UUIDV4 => "'%value%' is not a v4 UUID valid against RFC 4122"
    );

    public function isValid($value)
    {
        $this->setValue($value);

        if (1 !== preg_match('/([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})/', $value)) {
            $this->error(self::UUIDV4);
            return false;
        }

        return true;
    }
}

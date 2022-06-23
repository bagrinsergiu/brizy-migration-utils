<?php


namespace Brizy;

class WPGlobalBlockRulesContext extends Context
{

    /**
     * WPGlobalBlockRulesContext constructor.
     *
     * @param $data
     * @throws \Exception
     */
    public function __construct($data)
    {
        if (!is_object($data))
            throw new \Exception('$data invalid argument type. Object expected.');

        parent::__construct($data);
    }
}

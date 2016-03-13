<?php
/**
 * Created on: 2016-03-02
 * @copyright Inchoo d.o.o. (http://inchoo.net)
 * @author Benjam Welker
 * @license MIT
 */
class Inchoo_PHP7_Model_Resource_Index extends Enterprise_TargetRule_Model_Resource_Index
{

    protected function _prepareRuleActionSelectBind($object, $actionBind)
    {
        $bind = array();
        if ( ! is_array($actionBind)) {
            $actionBind = array();
        }

        foreach ($actionBind as $bindData) {
            if ( ! is_array($bindData) || ! array_key_exists('bind', $bindData) || ! array_key_exists('field', $bindData)) {
                continue;
            }
            $k = $bindData['bind'];
            $v = $object->getProduct()->getDataUsingMethod($bindData['field']);

            if ( ! empty($bindData['callback'])) {
                $callbacks = $bindData['callback'];
                if ( ! is_array($callbacks)) {
                    $callbacks = array($callbacks);
                }
                foreach ($callbacks as $callback) {
                    if (is_array($callback)) {
                        $v = $this->{$callback[0]}($v, $callback[1]);
                    } else {
                        $v = $this->$callback($v);
                    }
                }
            }

            if (is_array($v)) {
                $v = join(',', $v);
            }

            $bind[$k] = $v;
        }

        return $bind;
    }

}

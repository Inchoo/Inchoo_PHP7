<?php
/**
 * Created on: 08.12.15.
 * @copyright Inchoo d.o.o. (http://inchoo.net)
 * @author Ivan Čurdinjaković
 * @license MIT
 */ 
class Inchoo_PHP7_Model_Export_Entity_Customer extends Mage_ImportExport_Model_Export_Entity_Customer
{
    public function filterAttributeCollection(Mage_Eav_Model_Resource_Entity_Attribute_Collection $collection)
    {
        foreach (parent::filterAttributeCollection($collection) as $attribute) {
            if (!empty($this->_attributeOverrides[$attribute->getAttributeCode()])) {
                $data = $this->_attributeOverrides[$attribute->getAttributeCode()];

                if (isset($data['options_method']) && method_exists($this, $data['options_method'])) {
                    $data['filter_options'] = $this->{$data['options_method']}();
                }
                $attribute->addData($data);
            }
        }
        return $collection;
    }
}
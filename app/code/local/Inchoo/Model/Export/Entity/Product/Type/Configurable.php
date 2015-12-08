<?php
/**
 * Created on: 08.12.15.
 * Inchoo d.o.o.
 * @author Ivan Čurdinjaković <ivan.curdinjakovic@inchoo.net>
 */ 
class Inchoo_PHP7_Model_Export_Entity_Product_Type_Configurable
    extends Mage_ImportExport_Model_Export_Entity_Product_Type_Configurable
{
    public function overrideAttribute(Mage_Catalog_Model_Resource_Eav_Attribute $attribute)
    {
        if (!empty($this->_attributeOverrides[$attribute->getAttributeCode()])) {
            $data = $this->_attributeOverrides[$attribute->getAttributeCode()];

            if (isset($data['options_method']) && method_exists($this, $data['options_method'])) {
                $data['filter_options'] = $this->{$data['options_method']}();
            }
            $attribute->addData($data);

            return true;
        }
        return false;
    }
}
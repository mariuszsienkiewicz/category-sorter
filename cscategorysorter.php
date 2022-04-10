<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

class CsCategorySorter extends Module
{
    public function __construct()
    {
        $this->name = 'cscategorysorter';
        $this->tab = 'administration';
        $this->version = '1.0.1';
        $this->author = 'Codescape';
        $this->ps_versions_compliancy = [
            'min' => '1.7.5',
            'max' => '1.7.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Cs Category Sorter');
        $this->description = $this->l('Gives the possibility to sort the subcategories.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }

    public function install()
    {
        return parent::install()
            && $this->installTab()
        ;
    }

    public function uninstall()
    {
        return parent::uninstall()

            && $this->uninstallTab()
        ;
    }

    private function installTab()
    {
        $tabId = (int) Tab::getIdFromClassName('CategorySorterController');
        if (!$tabId) {
            $tabId = null;
        }

        $tab = new Tab($tabId);
        $tab->active = 1;
        $tab->class_name = 'CategorySorterController';
        $tab->route_name = 'cs_category_sorter_index';
        $tab->name = [];
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = 'Category Sorter';
        }
        $tab->id_parent = (int) Tab::getIdFromClassName('AdminCatalog');
        $tab->module = $this->name;

        return $tab->save();
    }

    private function uninstallTab()
    {
        $tabId = (int) Tab::getIdFromClassName('CategorySorterController');
        if (!$tabId) {
            return true;
        }

        $tab = new Tab($tabId);

        return $tab->delete();
    }

    protected function generateControllerURI()
    {
        $router = SymfonyContainer::getInstance()->get('router');

        return $router->generate('cs_category_sorter_index');
    }
}

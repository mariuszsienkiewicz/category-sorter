<?php

namespace CsCategorySorter\Adapter\Category;

use Category;

class CategorySorterDataUpdater
{
    /**
     * Sorts the children categories
     *
     * @param array $categoryListId parent categories
     * @param bool $ascOrder true - ascending, false - descending order
     *
     * @return void
     */
    public function sortChildrenCategories(array $categoryListId, bool $ascOrder)
    {
        foreach ($categoryListId as $categoryId) {
            $parent = new Category($categoryId);
            $nested = $parent->recurseLiteCategTree(1, null)['children'];
            usort($nested, function ($a, $b) use ($ascOrder) {
                return $ascOrder ? strcmp($a['name'], $b['name']) : strcmp($b['name'], $a['name']);
            });

            $position = 0;
            foreach ($nested as $child) {
                $currentCategory = new Category($child['id']);
                $currentCategory->addPosition($position);

                ++$position;
            }
        }
    }
}

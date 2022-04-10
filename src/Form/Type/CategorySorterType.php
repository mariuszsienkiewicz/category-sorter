<?php

namespace CsCategorySorter\Form\Type;

use CsCategorySorter\Enum\SortOrderEnum;
use PrestaShopBundle\Form\Admin\Type\CategoryChoiceTreeType;
use PrestaShopBundle\Form\Admin\Type\CommonAbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorySorterType extends CommonAbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', CategoryChoiceTreeType::class, [
                'label' => 'Choose parent categories',
                'multiple' => true,
                'required' => true,
            ])
            ->add('order', ChoiceType::class, [
                'label' => 'Select sort order',
                'choices' => [
                    'Ascending' => SortOrderEnum::SORT_MODE_ASC,
                    'Descending' => SortOrderEnum::SORT_MODE_DESC,
                ],
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'category_sorter';
    }
}

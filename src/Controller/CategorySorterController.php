<?php

namespace CsCategorySorter\Controller;

use CsCategorySorter\Enum\SortOrderEnum;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;

class CategorySorterController extends FrameworkBundleAdminController
{
    /**
     * Renders the form.
     *
     * @return Response
     */
    public function index()
    {
        $form = $this->get('cs_category_sorter.form_handler')->getForm();

        return $this->render(
            '@Modules/cscategorysorter/views/templates/admin/main.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Process the form and order the subcategories.
     *
     * @param Request $request
     *
     * @return void
     */
    public function process(Request $request)
    {
        /** @var FormHandlerInterface $formHandler */
        $formHandler = $this->get('cs_category_sorter.form_handler');
        $form = $formHandler->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();

                /** @var \CsCategorySorter\Adapter\Category\CategorySorterDataUpdater */
                $updater = $this->get('cs_category_sorter.data_updater');
                $sortOrder = $data['category_sorter']['order'] == SortOrderEnum::SORT_MODE_ASC;
                $updater->sortChildrenCategories($data['category_sorter']['categories'], $sortOrder);

                $this->addFlash('success', $this->trans('Success', 'Admin.Notifications.Success'));

                return $this->redirectToRoute('cs_category_sorter_index');
            }
        }

        $this->addFlash('success', $this->trans('Error', 'Admin.Notifications.Error'));
        return $this->redirectToRoute('cs_category_sorter_index');
    }
}

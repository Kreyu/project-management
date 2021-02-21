<?php

declare(strict_types=1);

namespace App\Project\Form\Type;

use App\Project\Form\Data\ProjectData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjectData::class,
        ]);
    }

    public function mapDataToForms($viewData, iterable $forms): void
    {
        $viewData ??= new ProjectData();

        if (!$viewData instanceof ProjectData) {
            throw new UnexpectedTypeException($viewData, ProjectData::class);
        }

        $forms = (array) $forms;
        $forms['name']->setData($viewData->name);
        $forms['description']->setData($viewData->description);
    }

    public function mapFormsToData(iterable $forms, &$viewData): void
    {
        $forms = (array) $forms;

        $viewData = new ProjectData;
        $viewData->name = $forms['name']->getData();
        $viewData->description = $forms['description']->getData();
    }
}

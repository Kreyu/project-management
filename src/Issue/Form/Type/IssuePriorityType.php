<?php

declare(strict_types=1);

namespace App\Issue\Form\Type;

use App\Issue\Form\Data\IssuePriorityData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IssuePriorityType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('icon', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IssuePriorityData::class,
        ]);
    }

    public function mapDataToForms($viewData, iterable $forms): void
    {
        $viewData ??= new IssuePriorityData();

        if (!$viewData instanceof IssuePriorityData) {
            throw new UnexpectedTypeException($viewData, IssuePriorityData::class);
        }

        $forms = (array) $forms;
        $forms['name']->setData($viewData->name);
        $forms['description']->setData($viewData->description);
        $forms['icon']->setData($viewData->icon);
    }

    public function mapFormsToData(iterable $forms, &$viewData): void
    {
        $forms = (array) $forms;

        $viewData = new IssuePriorityData;
        $viewData->name = $forms['name']->getData();
        $viewData->description = $forms['description']->getData();
        $viewData->icon = $forms['icon']->getData();
    }
}

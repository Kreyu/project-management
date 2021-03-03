<?php

declare(strict_types=1);

namespace App\Issue\Form\Type;

use App\Issue\Form\Data\IssueStatusData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IssueStatusType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('colorHex', ColorType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IssueStatusData::class,
        ]);
    }

    public function mapDataToForms($viewData, iterable $forms): void
    {
        $viewData ??= new IssueStatusData();

        if (!$viewData instanceof IssueStatusData) {
            throw new UnexpectedTypeException($viewData, IssueStatusData::class);
        }

        $forms = (array) $forms;
        $forms['name']->setData($viewData->name);
        $forms['description']->setData($viewData->description);
        $forms['colorHex']->setData($viewData->colorHex);
    }

    public function mapFormsToData(iterable $forms, &$viewData): void
    {
        $forms = (array) $forms;

        $viewData = new IssueStatusData;
        $viewData->name = $forms['name']->getData();
        $viewData->description = $forms['description']->getData();
        $viewData->colorHex = $forms['colorHex']->getData();
    }
}

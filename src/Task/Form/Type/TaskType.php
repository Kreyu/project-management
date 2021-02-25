<?php

declare(strict_types=1);

namespace App\Task\Form\Type;

use App\Issue\Model\Issue;
use App\Task\Form\Data\TaskData;
use App\Project\Repository\ProjectRepositoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType implements DataMapperInterface
{
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('issue', EntityType::class, [
                'class' => Issue::class,
                'choice_label' => 'subject',
                'choices' => [], // TODO
            ])
            ->add('subject', TextType::class)
            ->add('description', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TaskData::class,
        ]);
    }

    public function mapDataToForms($viewData, iterable $forms): void
    {
        $viewData ??= new TaskData();

        if (!$viewData instanceof TaskData) {
            throw new UnexpectedTypeException($viewData, TaskData::class);
        }

        $forms = (array) $forms;
        $forms['issue']->setData($viewData->issue);
        $forms['subject']->setData($viewData->subject);
        $forms['description']->setData($viewData->description);
    }

    public function mapFormsToData(iterable $forms, &$viewData): void
    {
        $forms = (array) $forms;

        $viewData = new TaskData;
        $viewData->issue = $forms['issue']->getData();
        $viewData->subject = $forms['subject']->getData();
        $viewData->description = $forms['description']->getData();
    }
}

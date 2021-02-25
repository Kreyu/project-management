<?php

declare(strict_types=1);

namespace App\Issue\Form\Type;

use App\Issue\Form\Data\IssueData;
use App\Project\Model\Project;
use App\Project\Repository\ProjectRepositoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IssueType extends AbstractType implements DataMapperInterface
{
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'name',
                'choices' => [], // TODO
            ])
            ->add('subject', TextType::class)
            ->add('description', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IssueData::class,
        ]);
    }

    public function mapDataToForms($viewData, iterable $forms): void
    {
        $viewData ??= new IssueData();

        if (!$viewData instanceof IssueData) {
            throw new UnexpectedTypeException($viewData, IssueData::class);
        }

        $forms = (array) $forms;
        $forms['project']->setData($viewData->project);
        $forms['subject']->setData($viewData->subject);
        $forms['description']->setData($viewData->description);
    }

    public function mapFormsToData(iterable $forms, &$viewData): void
    {
        $forms = (array) $forms;

        $viewData = new IssueData;
        $viewData->project = $forms['project']->getData();
        $viewData->subject = $forms['subject']->getData();
        $viewData->description = $forms['description']->getData();
    }
}

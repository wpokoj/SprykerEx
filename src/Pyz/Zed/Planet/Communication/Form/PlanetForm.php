<?php

namespace Pyz\Zed\Planet\Communication\Form;

use Generated\Shared\Transfer\PlanetTransfer;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PlanetForm extends AbstractType {

    private const FIELD_NAME = 'name';
    private const FIELD_INTERESTING_FACT = 'interesting_fact';
    private const BUTTON_SUBMIT = 'Submit';

    public function getBlockPrefix() {
        return 'planet';
    }

    public function configureOptions(OptionsResolver $resolver) {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => PlanetTransfer::class
        ]);
    }


    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void {

        $this
            ->addNameField($builder)
            ->addInterestingFactField($builder)
            ->addSubmitButton($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */

    private function addNameField(FormBuilderInterface $builder): PlanetForm
    {
        $builder->add(static::FIELD_NAME, TextType::class, [
            'constraints' => [
                new NotBlank(),
            ]
        ]);
        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    private function addInterestingFactField(FormBuilderInterface $builder): PlanetForm
    {
        $builder->add(static::FIELD_INTERESTING_FACT, TextType::class, [
            'constraints' => [
                new NotBlank(),
                new Length([
                    'min' => 15,
                    'minMessage' => 'Interesting fact minimum length is at least {{ limit }}',
                ]),
            ]
        ]);
        return $this;
    }

    private function addSubmitButton(FormBuilderInterface $builder) {
        $builder->add(static::BUTTON_SUBMIT, SubmitType::class);
        return $this;
    }
}

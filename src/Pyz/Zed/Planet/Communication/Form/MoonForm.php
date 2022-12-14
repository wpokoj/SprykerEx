<?php

namespace Pyz\Zed\Planet\Communication\Form;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzMoonQuery;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MoonForm extends AbstractType {

    private const FIELD_NAME = 'name';
    private const FIELD_ORBIT_TIME = 'orbit_time';
    private const FIELD_ID_PLANET = 'id_planet';
    private const BUTTON_SUBMIT = 'Submit';

    public function getBlockPrefix() {
        return 'moon';
    }

    public function configureOptions(OptionsResolver $resolver) {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => MoonTransfer::class
        ]);
    }


    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void {

        $this
            ->addNameField($builder)
            ->addOrbitedPlanetField($builder)
            ->addOrbitTimeField($builder)
            ->addSubmitButton($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */

    private function addNameField(FormBuilderInterface $builder): MoonForm
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
    private function addOrbitedPlanetField(FormBuilderInterface $builder): MoonForm
    {

        // TODO: Make this comply with layers segregation
        $query = new PyzPlanetQuery();

        $planets = $query->find();

        $opts = [];

        foreach ($planets as $planet) {
            $opts[$planet->getName()] = $planet->getIdPlanet();
        }

        $builder->add(static::FIELD_ID_PLANET, ChoiceType::class, [
            'choices' => $opts,
        ]);
        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    private function addOrbitTimeField(FormBuilderInterface $builder): MoonForm
    {
        $builder->add(static::FIELD_ORBIT_TIME, TextType::class, [
            'constraints' => [
                new NotBlank()
            ]
        ]);
        return $this;
    }

    private function addSubmitButton(FormBuilderInterface $builder) {
        $builder->add(static::BUTTON_SUBMIT, SubmitType::class);
        return $this;
    }
}

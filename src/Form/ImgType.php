<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ImgType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                "label" => "Image (jpg, png)",
                "mapped" => false,
                'required' => false,
                'constraints' => [
                    new File([
                            'maxSize' => '5000k',
                            'mimeTypes' => [
                                'image/jpg',
                                'image/png'
                            ],
                            'mimeTypesMessage' => 'not a valid image type , only image types jpg, png'
                        ]
                    )]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

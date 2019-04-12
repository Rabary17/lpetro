<?php
    namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Hobby;

class HobbiesTransformer implements DataTransformerInterface
{
    private $manager;

    /**
     * [__construct description]
     *
     * @param ObjectManager $manager [description]
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transform
     *
     * @param  string $value tag
     * @return string        [description]
     */
    public function transform($value)
    {
        return implode(',', $value);
    }

    /**
     * Reverse transform
     *
     * @param  string $string [description]
     * @return array          [description]
     */
    public function reverseTransform($string)
    {
        $names = array_unique(array_filter(array_map('trim', explode(',', $string))));
        $hobbies = $this->manager->getRepository('App:Hobby')->findByName($names);
        $newNames =  array_diff($names, $hobbies);

        foreach ($newNames as $name) {
            $hobby = new Hobby();
            $hobby->setName($name);
            $hobbies[] = $hobby;
        }
        return $hobbies;
    }
}

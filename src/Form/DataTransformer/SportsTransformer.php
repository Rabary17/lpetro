<?php
    namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Sport;

class SportsTransformer implements DataTransformerInterface
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
        $sports = $this->manager->getRepository('App:Sport')->findByName($names);
        $newNames =  array_diff($names, $sports);

        foreach ($newNames as $name) {
            $sport = new Sport();
            $sport->setName($name);
            $sports[] = $sport;
        }
        return $sports;
    }
}

<?php
	namespace App\Form\DataTransformer;

	use Symfony\Component\Form\DataTransformerInterface;
	use Doctrine\Common\Persistence\ObjectManager;
	use App\Entity\Tag;
	
	class TagsTransformer implements DataTransformerInterface
	{
		private $manager;

		/**
		 * [__construct description]
		 * @param ObjectManager $manager [description]
		 */
		public function __construct(ObjectManager $manager)
		{
			$this->manager = $manager;
		}

		/**
		 * Transform
		 * @param  string $value tag
		 * @return string        [description]
		 */
		public function transform($value)
		{
			return implode(',', $value);
		}

		/**
		 * Reverse transform
		 * @param  string $string [description]
		 * @return array          [description]
		 */
		public function reverseTransform($string)
		{
			$names = array_unique(array_filter(array_map('trim', explode(',', $string))));
			$tags = $this->manager->getRepository('App:Tag')->findByName($names);
			$newNames =  array_diff($names, $tags);

			foreach ($newNames as $name) {
				$tag = new Tag();
				$tag->setName($name);
				$tags[] = $tag;
			}
			return $tags;
		}
	}
<?php

namespace App\DataFixtures;

use App\Entity\Bar;
use App\Entity\Baz;
use App\Entity\Foo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $manager->persist(
                (new Foo())
                    ->setName(sprintf("Foo %d", $i))
                    ->addBar((new Bar())->setName("Bar 1"))
                    ->addBar((new Bar())->setName("Bar 2"))
                    ->addBaz((new Baz())->setName("Baz 1"))
                    ->addBaz((new Baz())->setName("Baz 2"))
            );
        }

        $manager->flush();
    }
}

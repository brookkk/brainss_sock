<?php

namespace Brains\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BrainsUserBundle extends Bundle
{
	public function getParent()
  {
    return 'FOSUserBundle';
  }
}

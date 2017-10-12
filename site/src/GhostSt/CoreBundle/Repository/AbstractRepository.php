<?php

namespace GhostSt\CoreBundle\Repository;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Stubs\DocumentManager;

/**
 * Abstract repository
 */
abstract class AbstractRepository
{
    /**
     * Document manager
     *
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * Constructor
     *
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->documentManager = $managerRegistry->getManager();
    }

    /**
     * Gets document manager
     *
     * @return DocumentManager
     */
    protected function getDocumentManager()
    {
        return $this->documentManager;
    }
}

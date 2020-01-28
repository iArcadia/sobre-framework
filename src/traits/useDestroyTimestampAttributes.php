<?php

namespace SobreFramework\Core\Traits;

/**
 * Trait useDestroyTimestampAttributes
 * @package SobreFramework\Core\Traits
 */
trait useDestroyTimestampAttributes
{
    protected
        /** @var int|null The timestamp when the element was removed. */
        $destroyed_at,
        /** @var int|null The ID of the user who removed the element. */
        $destroyed_by;

    /**
     * Get the timestamp when the element was removed or null if not removed.
     *
     * @return int|null
     */
    public function getDestroyedAt(): ?int
    {
        return $this->destroyed_at;
    }

    /**
     * Set the timestamp when the element was removed or null if not removed.
     *
     * @param int|null $destroyed_at
     * @return $this
     */
    public function setDestroyedAt(?int $destroyed_at = null): self
    {
        $this->destroyed_at = $destroyed_at;

        return $this;
    }

    /**
     * Get the ID of the user who removed the element or null if not removed.
     *
     * @return int|null
     */
    public function getDestroyedBy(): ?int
    {
        return $this->destroyed_by;
    }

    /**
     * Set the ID of the user who removed the element or null if not removed.
     *
     * @param int|null $destroyed_by
     * @return $this
     */
    public function setDestroyedBy(?int $destroyed_by = null): self
    {
        $this->destroyed_by = $destroyed_by;

        return $this;
    }
}

<?php

namespace Kachuru\Zone\Dto\Langton;

readonly class LangtonMove implements \JsonSerializable
{
    public function __construct(
        private string $antStateOrientation,
        private int $antStateLocation,
        private int $updateTileLocation,
        private string $updateTileState
    ) {
    }

    public function getAntStateOrientation(): string
    {
        return $this->antStateOrientation;
    }

    public function getAntStateLocation(): int
    {
        return $this->antStateLocation;
    }

    public function getUpdateTileLocation(): int
    {
        return $this->updateTileLocation;
    }

    public function getUpdateTileState(): string
    {
        return $this->updateTileState;
    }

    /**
     * @return array<string, string|int>
     */
    public function jsonSerialize(): array
    {
        return [
            'antStateOrientation' => $this->antStateOrientation,
            'antStateLocation' => $this->antStateLocation,
            'updateTileLocation' => $this->updateTileLocation,
            'updateTileState' => $this->updateTileState,
        ];
    }
}

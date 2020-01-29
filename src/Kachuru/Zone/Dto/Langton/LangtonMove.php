<?php

namespace Kachuru\Zone\Dto\Langton;

class LangtonMove implements \JsonSerializable
{
    private $antStateOrientation;

    private $antStateLocation;

    private $updateTileLocation;

    private $updateTileState;

    public function __construct(
        string $antStateOrientation,
        int $antStateLocation,
        int $updateTileLocation,
        string $updateTileState
    ) {
        $this->antStateOrientation = $antStateOrientation;
        $this->antStateLocation = $antStateLocation;
        $this->updateTileLocation = $updateTileLocation;
        $this->updateTileState = $updateTileState;
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

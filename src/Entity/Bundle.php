<?php

namespace App\Entity;

use App\Repository\BundleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BundleRepository::class)
 */
class Bundle implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $tech_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $critical_data;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_local;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_low_definition;

    /**
     * @ORM\Column(type="integer")
     */
    public $version;

    /**
     * @ORM\ManyToOne(targetEntity="Platform")
     * @ORM\JoinColumn(name="platform_id", referencedColumnName="id")
     **/
    private $platform;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTechName(): ?string
    {
        return $this->tech_name;
    }

    public function setTechName(string $tech_name): self
    {
        $this->tech_name = $tech_name;

        return $this;
    }

    public function getCriticalData(): ?int
    {
        return $this->critical_data;
    }

    public function setCriticalData(int $critical_data): self
    {
        $this->critical_data = $critical_data;

        return $this;
    }

    public function getIsLocal(): ?bool
    {
        return $this->is_local;
    }

    public function setIsLocal(bool $is_local): self
    {
        $this->is_local = $is_local;

        return $this;
    }

    public function getIsLowDefinition(): ?bool
    {
        return $this->is_low_definition;
    }

    public function setIsLowDefinition(bool $is_low_definition): self
    {
        $this->is_low_definition = $is_low_definition;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(Platform $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'tech_name' => $this->tech_name,
            'critical_data' => (int)$this->critical_data,
            'is_local' => (int)$this->is_local,
            'is_low_definition' => (int)$this->is_low_definition,
            'version' => (int)$this->version
        ];
    }
}

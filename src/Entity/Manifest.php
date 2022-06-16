<?php

namespace App\Entity;

use App\Repository\ManifestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ManifestRepository::class)
 */
class Manifest implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="Platform")
     * @ORM\JoinColumn(name="platform_id", referencedColumnName="id")
     **/
    private $platform;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Bundle")
     * @ORM\JoinTable(name="manifest_bundle",
     *      joinColumns={@ORM\JoinColumn(name="manifest_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="bundle_id", referencedColumnName="id")}
     *      )
     **/
    private $bundles;

    /**
     * @ORM\Column(type="text")
     */
    private $game_version;

    public function __construct()
    {
        $this->bundles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBundles(): ?object
    {
        return $this->bundles;
    }

    public function setBundles(string $bundles): self
    {
        $this->bundles = $bundles;

        return $this;
    }

    public function getGameVersion($isArray = false)
    {
        $versions = json_decode($this->game_version, true);
        if (is_array($versions))
        {
            if ($isArray)
            {
                return $versions;
            }

            return implode(' ', $versions);
        }

        return '';
    }

    public function setGameVersion(string $game_version): self
    {
        $game_version = trim(preg_replace('/\s+/', ' ', $game_version));
        $this->game_version = json_encode(explode(' ', $game_version));
        return $this;
    }

    public function addGameVersion(string $game_version): self
    {
        if (empty($this->game_version))
        {
            $this->setGameVersion($game_version);
            return $this;
        }

        $decoded = json_decode($this->game_version, true);
        $versions = [
            $game_version => null,
        ];

        foreach ($decoded as $v)
        {
            $versions[$v] = null;
        }

        $this->game_version = json_encode(array_keys($versions));
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'platform_id' => $this->platform->getId(),
            'game_version' => json_decode($this->game_version, true),

            // bundles is ArrayCollection
            'bundles' => $this->bundles->toArray(),
        ];
    }

    public function fixPlatformID(int $pid): int
    {
//3 IPHONE
//4 ANDROID
//9 AMAZON
//20 WIN8_STORE
//27 ANDROID_SAMSUNG
//30 ANDROID_BETA
//31 STEAM
//32 TRAIL_WEB_GL
        switch ($pid)
        {
            case 4:
            case 9:
            case 27:
            case 30:
                return 4;
        }

        return $pid;
    }
}

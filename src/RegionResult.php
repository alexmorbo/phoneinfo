<?php


namespace PhoneLib;


class RegionResult
{
    /**
     * @var string|null
     */
    private $country;
    /**
     * @var string|null
     */
    private $countryIsoCode;
    /**
     * @var string|null
     */
    private $federalDistrict;
    /**
     * @var string|null
     */
    private $fiasCode;
    /**
     * @var int|null
     */
    private $fiasLevel;
    /**
     * @var int|null
     */
    private $geoLat;
    /**
     * @var int|null
     */
    private $geoLon;
    /**
     * @var int|null
     */
    private $kladrId;
    /**
     * @var int|null
     */
    private $okato;
    /**
     * @var int|null
     */
    private $oktmo;
    /**
     * @var int|null
     */
    private $postalCode;
    /**
     * @var string|null
     */
    private $regionName;
    /**
     * @var string|null uuid
     */
    private $regionFiasId;
    /**
     * @var string|null
     */
    private $regionIsoCode;
    /**
     * @var int|null
     */
    private $regionKladrId;
    /**
     * @var string|null
     */
    private $regionType;
    /**
     * @var string|null
     */
    private $result;
    /**
     * @var string|null
     */
    private $timezone;
    /**
     * @var int|null
     */
    private $updated;

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getCountryIsoCode(): ?string
    {
        return $this->countryIsoCode;
    }

    /**
     * @param string|null $countryIsoCode
     */
    public function setCountryIsoCode(?string $countryIsoCode): void
    {
        $this->countryIsoCode = $countryIsoCode;
    }

    /**
     * @return string|null
     */
    public function getFederalDistrict(): ?string
    {
        return $this->federalDistrict;
    }

    /**
     * @param string|null $federalDistrict
     */
    public function setFederalDistrict(?string $federalDistrict): void
    {
        $this->federalDistrict = $federalDistrict;
    }

    /**
     * @return string|null
     */
    public function getFiasCode(): ?string
    {
        return $this->fiasCode;
    }

    /**
     * @param string|null $fiasCode
     */
    public function setFiasCode(?string $fiasCode): void
    {
        $this->fiasCode = $fiasCode;
    }

    /**
     * @return int|null
     */
    public function getFiasLevel(): ?int
    {
        return $this->fiasLevel;
    }

    /**
     * @param int|null $fiasLevel
     */
    public function setFiasLevel(?int $fiasLevel): void
    {
        $this->fiasLevel = $fiasLevel;
    }

    /**
     * @return int|null
     */
    public function getGeoLat(): ?int
    {
        return $this->geoLat;
    }

    /**
     * @param int|null $geoLat
     */
    public function setGeoLat(?int $geoLat): void
    {
        $this->geoLat = $geoLat;
    }

    /**
     * @return int|null
     */
    public function getGeoLon(): ?int
    {
        return $this->geoLon;
    }

    /**
     * @param int|null $geoLon
     */
    public function setGeoLon(?int $geoLon): void
    {
        $this->geoLon = $geoLon;
    }

    /**
     * @return int|null
     */
    public function getKladrId(): ?int
    {
        return $this->kladrId;
    }

    /**
     * @param int|null $kladrId
     */
    public function setKladrId(?int $kladrId): void
    {
        $this->kladrId = $kladrId;
    }

    /**
     * @return int|null
     */
    public function getOkato(): ?int
    {
        return $this->okato;
    }

    /**
     * @param int|null $okato
     */
    public function setOkato(?int $okato): void
    {
        $this->okato = $okato;
    }

    /**
     * @return int|null
     */
    public function getOktmo(): ?int
    {
        return $this->oktmo;
    }

    /**
     * @param int|null $oktmo
     */
    public function setOktmo(?int $oktmo): void
    {
        $this->oktmo = $oktmo;
    }

    /**
     * @return int|null
     */
    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    /**
     * @param int|null $postalCode
     */
    public function setPostalCode(?int $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string|null
     */
    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    /**
     * @param string|null $regionName
     */
    public function setRegionName(?string $regionName): void
    {
        $this->regionName = $regionName;
    }

    /**
     * @return string|null
     */
    public function getRegionFiasId(): ?string
    {
        return $this->regionFiasId;
    }

    /**
     * @param string|null $regionFiasId
     */
    public function setRegionFiasId(?string $regionFiasId): void
    {
        $this->regionFiasId = $regionFiasId;
    }

    /**
     * @return string|null
     */
    public function getRegionIsoCode(): ?string
    {
        return $this->regionIsoCode;
    }

    /**
     * @param string|null $regionIsoCode
     */
    public function setRegionIsoCode(?string $regionIsoCode): void
    {
        $this->regionIsoCode = $regionIsoCode;
    }

    /**
     * @return int|null
     */
    public function getRegionKladrId(): ?int
    {
        return $this->regionKladrId;
    }

    /**
     * @param int|null $regionKladrId
     */
    public function setRegionKladrId(?int $regionKladrId): void
    {
        $this->regionKladrId = $regionKladrId;
    }

    /**
     * @return string|null
     */
    public function getRegionType(): ?string
    {
        return $this->regionType;
    }

    /**
     * @param string|null $regionType
     */
    public function setRegionType(?string $regionType): void
    {
        $this->regionType = $regionType;
    }

    /**
     * @return string|null
     */
    public function getResult(): ?string
    {
        return $this->result;
    }

    /**
     * @param string|null $result
     */
    public function setResult(?string $result): void
    {
        $this->result = $result;
    }

    /**
     * @return string|null
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * @param string|null $timezone
     */
    public function setTimezone(?string $timezone): void
    {
        $this->timezone = $timezone;
    }

    /**
     * @return int|null
     */
    public function getUpdated(): ?int
    {
        return $this->updated;
    }

    /**
     * @param int|null $updated
     */
    public function setUpdated(?int $updated): void
    {
        $this->updated = $updated;
    }
}
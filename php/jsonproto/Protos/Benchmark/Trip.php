<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# NO CHECKED-IN PROTOBUF GENCODE
# source: benchmark.proto

namespace Benchmark;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>benchmark.Trip</code>
 */
class Trip extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string id = 1;</code>
     */
    protected $id = '';
    /**
     * Generated from protobuf field <code>string code = 2;</code>
     */
    protected $code = '';
    /**
     * Generated from protobuf field <code>string externalId = 3;</code>
     */
    protected $externalId = '';
    /**
     * Generated from protobuf field <code>string department = 4;</code>
     */
    protected $department = '';
    /**
     * Generated from protobuf field <code>string driverName = 5;</code>
     */
    protected $driverName = '';
    /**
     * Generated from protobuf field <code>string driverMobile = 6;</code>
     */
    protected $driverMobile = '';
    /**
     * Generated from protobuf field <code>string vehicleRegistration = 7;</code>
     */
    protected $vehicleRegistration = '';
    /**
     * Generated from protobuf field <code>string vehicleType = 8;</code>
     */
    protected $vehicleType = '';
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedStartAt = 9;</code>
     */
    protected $plannedStartAt = null;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedEndAt = 10;</code>
     */
    protected $plannedEndAt = null;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualStartAt = 11;</code>
     */
    protected $actualStartAt = null;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualEndAt = 12;</code>
     */
    protected $actualEndAt = null;
    /**
     * Generated from protobuf field <code>.benchmark.TripStatus status = 13;</code>
     */
    protected $status = 0;
    /**
     * Generated from protobuf field <code>repeated .benchmark.Transport transports = 14;</code>
     */
    private $transports;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp createdAt = 15;</code>
     */
    protected $createdAt = null;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp updatedAt = 16;</code>
     */
    protected $updatedAt = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $id
     *     @type string $code
     *     @type string $externalId
     *     @type string $department
     *     @type string $driverName
     *     @type string $driverMobile
     *     @type string $vehicleRegistration
     *     @type string $vehicleType
     *     @type \Google\Protobuf\Timestamp $plannedStartAt
     *     @type \Google\Protobuf\Timestamp $plannedEndAt
     *     @type \Google\Protobuf\Timestamp $actualStartAt
     *     @type \Google\Protobuf\Timestamp $actualEndAt
     *     @type int $status
     *     @type array<\Benchmark\Transport>|\Google\Protobuf\Internal\RepeatedField $transports
     *     @type \Google\Protobuf\Timestamp $createdAt
     *     @type \Google\Protobuf\Timestamp $updatedAt
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Benchmark::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string code = 2;</code>
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Generated from protobuf field <code>string code = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->code = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string externalId = 3;</code>
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * Generated from protobuf field <code>string externalId = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setExternalId($var)
    {
        GPBUtil::checkString($var, True);
        $this->externalId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string department = 4;</code>
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Generated from protobuf field <code>string department = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setDepartment($var)
    {
        GPBUtil::checkString($var, True);
        $this->department = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string driverName = 5;</code>
     * @return string
     */
    public function getDriverName()
    {
        return $this->driverName;
    }

    /**
     * Generated from protobuf field <code>string driverName = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setDriverName($var)
    {
        GPBUtil::checkString($var, True);
        $this->driverName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string driverMobile = 6;</code>
     * @return string
     */
    public function getDriverMobile()
    {
        return $this->driverMobile;
    }

    /**
     * Generated from protobuf field <code>string driverMobile = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setDriverMobile($var)
    {
        GPBUtil::checkString($var, True);
        $this->driverMobile = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string vehicleRegistration = 7;</code>
     * @return string
     */
    public function getVehicleRegistration()
    {
        return $this->vehicleRegistration;
    }

    /**
     * Generated from protobuf field <code>string vehicleRegistration = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setVehicleRegistration($var)
    {
        GPBUtil::checkString($var, True);
        $this->vehicleRegistration = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string vehicleType = 8;</code>
     * @return string
     */
    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    /**
     * Generated from protobuf field <code>string vehicleType = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setVehicleType($var)
    {
        GPBUtil::checkString($var, True);
        $this->vehicleType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedStartAt = 9;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getPlannedStartAt()
    {
        return $this->plannedStartAt;
    }

    public function hasPlannedStartAt()
    {
        return isset($this->plannedStartAt);
    }

    public function clearPlannedStartAt()
    {
        unset($this->plannedStartAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedStartAt = 9;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setPlannedStartAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->plannedStartAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedEndAt = 10;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getPlannedEndAt()
    {
        return $this->plannedEndAt;
    }

    public function hasPlannedEndAt()
    {
        return isset($this->plannedEndAt);
    }

    public function clearPlannedEndAt()
    {
        unset($this->plannedEndAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedEndAt = 10;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setPlannedEndAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->plannedEndAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualStartAt = 11;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getActualStartAt()
    {
        return $this->actualStartAt;
    }

    public function hasActualStartAt()
    {
        return isset($this->actualStartAt);
    }

    public function clearActualStartAt()
    {
        unset($this->actualStartAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualStartAt = 11;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setActualStartAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->actualStartAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualEndAt = 12;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getActualEndAt()
    {
        return $this->actualEndAt;
    }

    public function hasActualEndAt()
    {
        return isset($this->actualEndAt);
    }

    public function clearActualEndAt()
    {
        unset($this->actualEndAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualEndAt = 12;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setActualEndAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->actualEndAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.benchmark.TripStatus status = 13;</code>
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Generated from protobuf field <code>.benchmark.TripStatus status = 13;</code>
     * @param int $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkEnum($var, \Benchmark\TripStatus::class);
        $this->status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .benchmark.Transport transports = 14;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTransports()
    {
        return $this->transports;
    }

    /**
     * Generated from protobuf field <code>repeated .benchmark.Transport transports = 14;</code>
     * @param array<\Benchmark\Transport>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTransports($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Benchmark\Transport::class);
        $this->transports = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp createdAt = 15;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function hasCreatedAt()
    {
        return isset($this->createdAt);
    }

    public function clearCreatedAt()
    {
        unset($this->createdAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp createdAt = 15;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setCreatedAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->createdAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp updatedAt = 16;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function hasUpdatedAt()
    {
        return isset($this->updatedAt);
    }

    public function clearUpdatedAt()
    {
        unset($this->updatedAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp updatedAt = 16;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setUpdatedAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->updatedAt = $var;

        return $this;
    }

}


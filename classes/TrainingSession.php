<?php
class TrainingSession {
    private $trainingType;
    private $intensity;
    private $levelBefore;
    private $levelAfter;
    private $hpBefore;
    private $hpAfter;
    private $time;

    public function __construct($trainingType, $intensity, $levelBefore, $levelAfter, $hpBefore, $hpAfter) {
        $this->trainingType = $trainingType;
        $this->intensity = $intensity;
        $this->levelBefore = $levelBefore;
        $this->levelAfter = $levelAfter;
        $this->hpBefore = $hpBefore;
        $this->hpAfter = $hpAfter;
        $this->time = date('Y-m-d H:i:s');
    }

    // Getters
    public function getTrainingType() { return $this->trainingType; }
    public function getIntensity() { return $this->intensity; }
    public function getLevelBefore() { return $this->levelBefore; }
    public function getLevelAfter() { return $this->levelAfter; }
    public function getHpBefore() { return $this->hpBefore; }
    public function getHpAfter() { return $this->hpAfter; }
    public function getTime() { return $this->time; }
}
?>
<?php

/**
 * Simple test script to verify panel-specific filtering functionality
 * 
 * This script simulates the filtering logic without requiring a full Laravel environment
 */

/**
 * Base test report class
 */
class TestReport {
    public ?string $heading = 'Test Report';
    public ?string $group = null;
    protected array $panels = [];
    
    public function getPanels(): array
    {
        return $this->panels;
    }
}

class MockPanel {
    public function __construct(public string $id) {}
    public function getId(): string { return $this->id; }
}

class MockReportsPlugin {
    protected array $allowedReports = [];
    protected array $excludedReports = [];
    protected ?\Closure $reportFilter = null;

    public function reports(array $reports): static
    {
        $this->allowedReports = $reports;
        return $this;
    }

    public function excludeReports(array $reports): static
    {
        $this->excludedReports = $reports;
        return $this;
    }

    public function filterReports(\Closure $filter): static
    {
        $this->reportFilter = $filter;
        return $this;
    }

    public function shouldShowReport(string $reportClass, MockPanel $panel): bool
    {
        // Apply custom filter if set
        if ($this->reportFilter) {
            return call_user_func($this->reportFilter, $reportClass, $panel);
        }

        // If allowed reports are specified, only show those
        if (!empty($this->allowedReports)) {
            return in_array($reportClass, $this->allowedReports);
        }

        // If excluded reports are specified, hide those
        if (!empty($this->excludedReports)) {
            return !in_array($reportClass, $this->excludedReports);
        }

        // Check if report has panel-specific configuration
        $report = new $reportClass();
        if (method_exists($report, 'getPanels')) {
            $allowedPanels = $report->getPanels();
            return empty($allowedPanels) || in_array($panel->getId(), $allowedPanels);
        }

        return true; // Show all reports by default
    }
}

// Test reports
class AdminReport extends TestReport {
    protected array $panels = ['admin'];
    public function getPanels(): array { return $this->panels; }
}

class ManagerReport extends TestReport {
    protected array $panels = ['admin', 'manager'];
    public function getPanels(): array { return $this->panels; }
}

class CustomerReport extends TestReport {
    protected array $panels = ['customer'];
    public function getPanels(): array { return $this->panels; }
}

class PublicReport extends TestReport {
    // No panel restrictions
}

// Test scenarios
function runTests() {
    $adminPanel = new MockPanel('admin');
    $managerPanel = new MockPanel('manager');
    $customerPanel = new MockPanel('customer');
    
    $allReports = [
        AdminReport::class,
        ManagerReport::class,
        CustomerReport::class,
        PublicReport::class,
    ];

    echo "Testing Panel-Specific Report Filtering\n";
    echo "=====================================\n\n";

    // Test 1: Default behavior (report-level panel configuration)
    echo "Test 1: Report-level panel configuration\n";
    echo "-----------------------------------------\n";
    $plugin = new MockReportsPlugin();
    
    foreach (['admin', 'manager', 'customer'] as $panelId) {
        $panel = new MockPanel($panelId);
        echo "Panel: $panelId\n";
        
        foreach ($allReports as $reportClass) {
            $visible = $plugin->shouldShowReport($reportClass, $panel);
            $status = $visible ? '✓' : '✗';
            $className = basename(str_replace('\\', '/', $reportClass));
            echo "  $status $className\n";
        }
        echo "\n";
    }

    // Test 2: Plugin-level allowed reports
    echo "Test 2: Plugin-level allowed reports\n";
    echo "------------------------------------\n";
    $plugin = new MockReportsPlugin();
    $plugin->reports([AdminReport::class, ManagerReport::class]);
    
    foreach (['admin', 'manager', 'customer'] as $panelId) {
        $panel = new MockPanel($panelId);
        echo "Panel: $panelId (only AdminReport and ManagerReport allowed)\n";
        
        foreach ($allReports as $reportClass) {
            $visible = $plugin->shouldShowReport($reportClass, $panel);
            $status = $visible ? '✓' : '✗';
            $className = basename(str_replace('\\', '/', $reportClass));
            echo "  $status $className\n";
        }
        echo "\n";
    }

    // Test 3: Plugin-level excluded reports
    echo "Test 3: Plugin-level excluded reports\n";
    echo "-------------------------------------\n";
    $plugin = new MockReportsPlugin();
    $plugin->excludeReports([AdminReport::class]);
    
    foreach (['admin', 'manager', 'customer'] as $panelId) {
        $panel = new MockPanel($panelId);
        echo "Panel: $panelId (AdminReport excluded)\n";
        
        foreach ($allReports as $reportClass) {
            $visible = $plugin->shouldShowReport($reportClass, $panel);
            $status = $visible ? '✓' : '✗';
            $className = basename(str_replace('\\', '/', $reportClass));
            echo "  $status $className\n";
        }
        echo "\n";
    }

    // Test 4: Custom filter
    echo "Test 4: Custom filter logic\n";
    echo "---------------------------\n";
    $plugin = new MockReportsPlugin();
    $plugin->filterReports(function (string $reportClass, MockPanel $panel) {
        // Only show reports that contain the panel name in the class name
        return str_contains(strtolower($reportClass), strtolower($panel->getId()));
    });
    
    foreach (['admin', 'manager', 'customer'] as $panelId) {
        $panel = new MockPanel($panelId);
        echo "Panel: $panelId (custom filter: class name contains panel name)\n";
        
        foreach ($allReports as $reportClass) {
            $visible = $plugin->shouldShowReport($reportClass, $panel);
            $status = $visible ? '✓' : '✗';
            $className = basename(str_replace('\\', '/', $reportClass));
            echo "  $status $className\n";
        }
        echo "\n";
    }

    echo "All tests completed!\n";
}

runTests();

echo "Script execution completed.\n";

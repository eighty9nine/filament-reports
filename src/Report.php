<?php

namespace EightyNine\Reports;

use EightyNine\Reports\Components\Body;
use EightyNine\Reports\Components\Footer;
use EightyNine\Reports\Components\Header;
use EightyNine\Reports\Concerns\HasPageSettings;
use EightyNine\Reports\Concerns\ResolvesDynamicLivewireProperties;
use EightyNine\Reports\Contracts\HasBody;
use EightyNine\Reports\Contracts\HasFooter;
use EightyNine\Reports\Contracts\HasHeader;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Panel;
use Illuminate\Support\Facades\Route;

class Report extends Page implements HasBody, HasHeader, HasFooter
{
    use ResolvesDynamicLivewireProperties;

    public ?string $heading = "A list of repayments";

    public ?string $subHeading = "A list of repayments";

    public ?string $icon = "heroicon-o-document-text";

    public static string $view = 'filament-reports::pages.report';

    public ?string $group = null;

    public ?string $logo = "/img/logo.png";

    public function getHeading() : string {
        return $this->heading;
    }

    public function getSubHeading() : string {
        return $this->subHeading;
    }

    public function getIcon() : string {
        return $this->icon;
    }

    public function getGroup() : ?string {
        return $this->group;
    }

    public static function getRouteName(?string $panel = null): string
    {
        $panel ??= Filament::getCurrentPanel()->getId();

        return (string) str(static::getSlug())
            ->replace('/', '.')
            ->prepend("filament.{$panel}.reports.");
    }

    public function getTableHeader(): Header
    {
        return $this->header(Header::make($this));
    }

    public function getTableBody(): Body
    {
        return $this->body(Body::make($this));
    }

    public function getTableFooter(): Footer
    {
        return $this->footer(Footer::make($this));
    }

    public function header(Header $header): Header
    {
        return $header;
    }

    public function body(Body $body): Body
    {
        return $body;
    }

    public function footer(Footer $footer): Footer
    {
        return $footer;
    }
}

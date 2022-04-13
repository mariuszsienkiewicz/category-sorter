# PrestaShop Category Sorter

[![Latest release](https://img.shields.io/github/v/release/mariuszsienkiewicz/category-sorter?label=Latest%20release)](https://github.com/mariuszsienkiewicz/category-sorter/releases)
![Supported PrestaShop Version](https://img.shields.io/badge/Prestashop-&ge;1.7.5-gray?logo=prestashop)

Adds the ability in PrestaShop to sort subcategories of selected categories in ascending or descending order.

## Usage

This module will add its own tab in the catalog tab. Here you can select the parent category (you can select multiple at one time), choose the sort order, and click the save button. The module will do the rest of the work.

## Installation

### From release
1. Download the latest version of the module via the [Releases page](https://github.com/mariuszsienkiewicz/category-sorter/releases).
1. Go to the administration panel of your PrestaShop webshop.
1. In your administration panel, select the 'Modules' tab and then choose 'Upload a module'.
1. Select 'Select file' and then upload the '.zip' file which you downloaded earlier.

## Create a module from the source code

1. Go to the modules folder.
1. Clone this repository into the folder named `cscategorysorter`.
1. Get into this folder and run the following command:
```bash
composer dumpautoload
```
1. Go to the module catalog in the administration panel, find this module and click install.

## Reporting issues

You can report issues in the repository of this module. [Click here to report an issue][issue].

[issue]: https://github.com/mariuszsienkiewicz/category-sorter/issues/new

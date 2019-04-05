# RadItems ☢
Creates the ability to flag orders as containing radioactive items.

## Installation
Installation via composer is supported. More info: https://github.com/Cotya/magento-composer-installer

### Project Requirements
1. The module should add a new product attribute called "Half-life (seconds)" of type integer to all products
2. The module should add a new column "contains_radioactive_item" to the sales order
3. The threshold for whether an item is “radioactive” should be configurable in System > Configuration
4. The value of "Contains Radioactive Item" on the order should be "1" if any of the items in the order are a
product with a half-life value less than the current radioactive threshold setting, otherwise "0"
5. The value of "Contains Radioactive Item" on the order should be determined at order time
6. A yes/no column should be added to the sales order grid in the admin for Contains Radioactive Item that should be filterable and sortable
7. Add indication that an order contains radioactive items when viewing the order

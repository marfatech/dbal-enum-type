## [Unreleased]

## [2.0.0] - 2021-10-19
## Changed
- Updated `php` with pattern version `~7.4||~8.0`.
- Updated composer name `wakeapp/dbal-enum-type` to `marfatech/dbal-enum-type`.
- [BC BREAK] Refactoring namespace to `MarfaTech`.

## [1.0.1] - 2021-03-02
### Added
- Support PHP ~8.0.

## [1.0.0] - 2019-05-15
### Added
- Added information about license.
### Changed
- Extends `EnumException` from the `RuntimeException` instead `Exception`.

## [0.3.1] - 2019-01-31
### Fixed
- Add possibility receive NULL in `AbstractEnumType::convertToDatabaseValue`

## [0.3.0] - 2018-11-22
### Changed
- Totally reworked `AbstractEnumType`:
  - Removed constant `NAME` and replaced by `getTypeName` method.
  - Removed constant `BASE_ENUM_CLASS` and replaced by `getEnumClass` method.
  - Removed `AbstractEnumType::getEnumDeclaration` method as redundant.
  - Added possibility for set enum values manually.
### Removed
- Removed `AbstractEnum` class as redundant.

## [0.2.0] - 2018-11-13
### Added
- Added possibility for use `doctrine:schema:update` with the ENUM's filed type.

## [0.1.0] - 2018-09-11
### Added
- First release of this component.

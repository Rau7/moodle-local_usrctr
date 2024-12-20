# Moodle User Counter Plugin (usrctr)

This plugin allows you to set and enforce user limits in your Moodle installation. It provides functionality to:

- Set a maximum number of users allowed in your Moodle site
- Control whether suspended and deleted users count towards the limit
- Prevent new user creation when the limit is reached
- Show clear error messages when attempting to exceed the limit
- Control access to bulk user upload functionality based on the limit

## Installation

1. Download the plugin
2. Extract it to your Moodle's `/local` directory
3. Rename the extracted folder to `usrctr`
4. Visit your Moodle site's administration area to complete the installation

## Configuration

1. Go to Site administration > Plugins > Local plugins > User Counter
2. Set your desired user limit
3. Configure whether suspended and deleted users should count towards the limit

## Features

- Prevents user creation when limit is exceeded
- Shows clear error messages
- Integrates with Moodle's bulk user upload functionality
- Supports both English and Turkish languages

## Requirements

- Moodle 4.0 or higher

## License

This plugin is licensed under the GNU GPL v3 or later. See the LICENSE file for details.

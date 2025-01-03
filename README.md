

# Milestone Plugin

![Milestone Plugin Icon](icon.png)

## Overview

**Milestone Plugin** is a feature-rich Minecraft PocketMine plugin that rewards players upon reaching predefined financial milestones. It integrates seamlessly with the [BedrockEconomy](https://github.com/cooldogedev/BedrockEconomy) API, allowing server owners to create engaging, event-driven gameplay experiences.

## Features

- **Automatic Milestone Detection**: Tracks player balances in real-time using the `PlayerBalanceUpdateEvent`.
- **Customizable Rewards**: Configure rewards through commands and broadcast messages.
- **Player-Specific Milestones**: Each player has their unique progress tracking.
- **Lightweight and Efficient**: Designed to run smoothly without impacting server performance.

## Installation

1. Download the plugin's `.phar` file from the [Releases](https://github.com/SoyDavs/Milestone/releases) section.
2. Place the `.phar` file in your server's `plugins` directory.
3. Restart your server to load the plugin.

## Configuration

The plugin uses a YAML configuration file (`config.yml`) to define milestones. Example structure:

```yaml
milestones:
  - amount: 1000
    commands:
      - "give {player} diamond 5"
    broadcast: "{player} has reached a balance milestone of {amount}!"
  - amount: 5000
    commands:
      - "give {player} emerald 10"
    broadcast: "{player} is now a financial wizard with {amount} coins!"
```

- `amount`: The balance a player must reach to unlock this milestone.
- `commands`: A list of server commands executed upon milestone completion.
- `broadcast`: (Optional) A message broadcasted to all players.

## Requirements

- PocketMine-MP server
- [BedrockEconomy](https://github.com/cooldogedev/BedrockEconomy) plugin

## Usage

1. Edit the `config.yml` file to define milestones and rewards.
2. Reload the plugin using `/reload`.
3. Players will automatically receive rewards when they meet the milestone conditions.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Support

For questions, issues, or feature requests, open an issue on the [GitHub Issue Tracker](https://github.com/SoyDavs/Milestone/issues).

#!/bin/bash

# Sshelf (Secure Shelf) - One-line Installer
# https://github.com/syofyanzuhad/sshelf

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}=======================================${NC}"
echo -e "${BLUE}    Sshelf Installer (Public Beta)     ${NC}"
echo -e "${BLUE}=======================================${NC}"

# Check for root
if [ "$EUID" -ne 0 ]; then
  echo -e "${RED}Please run as root (sudo bash)${NC}"
  exit 1
fi

# Check for dependencies
check_command() {
    if ! command -v $1 &> /dev/null; then
        echo -e "${RED}Error: $1 is not installed.${NC}"
        return 1
    fi
    return 0
}

if ! check_command docker; then exit 1; fi
if ! check_command curl; then exit 1; fi

# Check for docker compose (v2) or docker-compose (v1)
if docker compose version &> /dev/null; then
    DOCKER_COMPOSE="docker compose"
elif command -v docker-compose &> /dev/null; then
    DOCKER_COMPOSE="docker-compose"
else
    echo -e "${RED}Error: Docker Compose is not installed.${NC}"
    exit 1
fi

# Configuration
INSTALL_DIR="/opt/sshelf"
REPO_RAW_URL="https://raw.githubusercontent.com/syofyanzuhad/sshelf/main"

echo -e "${BLUE}1. Preparing directory: ${INSTALL_DIR}${NC}"
mkdir -p "$INSTALL_DIR"
cd "$INSTALL_DIR"

echo -e "${BLUE}2. Downloading configuration files...${NC}"
curl -sSL "${REPO_RAW_URL}/docker-compose.yml" -o docker-compose.yml
curl -sSL "${REPO_RAW_URL}/.env.example" -o .env

# Generate random APP_KEY if not exists
if ! grep -q "APP_KEY=base64" .env; then
    echo -e "${BLUE}3. Generating Application Key...${NC}"
    RANDOM_KEY=$(openssl rand -base64 32)
    sed -i "s|APP_KEY=|APP_KEY=base64:${RANDOM_KEY}|g" .env
fi

# Detect Public IP
PUBLIC_IP=$(curl -s https://ifconfig.me || echo "localhost")
sed -i "s|APP_URL=http://localhost|APP_URL=http://${PUBLIC_IP}:8080|g" .env

echo -e "${BLUE}4. Starting Sshelf with Docker Compose...${NC}"
$DOCKER_COMPOSE pull
$DOCKER_COMPOSE up -d

echo -e "${GREEN}=======================================${NC}"
echo -e "${GREEN}    Installation Complete!             ${NC}"
echo -e "${GREEN}=======================================${NC}"
echo -e "Sshelf is now running at: ${BLUE}http://${PUBLIC_IP}:8080${NC}"
echo -e "You can manage Sshelf in: ${BLUE}${INSTALL_DIR}${NC}"
echo -e "${GREEN}=======================================${NC}"

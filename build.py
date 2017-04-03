from subprocess import call
from subprocess import Popen
from subprocess import PIPE
from subprocess import check_call
import re

IMAGE_PHP = 'ghostst/mafia-php'
IMAGE_NGINX = 'ghostst/mafia-nginx'
IMAGE_MONGODB = 'ghostst/mafia-mongodb'

DOCKERFILE_PHP_PATH = 'docker/php/DockerfileProd'
DOCKERFILE_NGINX_PATH = 'docker/nginx/DockerfileProd'
DOCKERFILE_MONGODB_PATH = 'docker/mongodb/Dockerfile'

COMMANDS = [
    {
        'image': IMAGE_PHP,
        'dockerfile': DOCKERFILE_PHP_PATH
    },
    {
        'image': IMAGE_NGINX,
        'dockerfile': DOCKERFILE_NGINX_PATH
    },
    {
        'image': IMAGE_MONGODB,
        'dockerfile': DOCKERFILE_MONGODB_PATH
    },
]

if __name__ == '__main__':
    for command in COMMANDS:
        print '\nBuilding image -' + command['image'] + '\n'
        proc = Popen(['docker', 'image', 'list', command['image']], stdout=PIPE)
        out, errs = proc.communicate()

        if re.search(command['image'], out):
            print 'Removing old image' + command['image'] + '\n'
            call(['docker', 'image', 'rm', '-f', command['image']])

        check_call(['docker', 'build', '-t', command['image'], '-f', command['dockerfile'], '.'])

    print "\nDocker images has been successfully built!"


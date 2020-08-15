FROM node:10

RUN npm install
# If you are building your code for production
# RUN npm ci --only=production

RUN npm run start
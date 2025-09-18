# ---------------------------
# Use the official Nginx Alpine image
# Alpine version is lightweight and optimized for production
# ---------------------------
FROM nginx:alpine

# ---------------------------
# Copy custom Nginx configuration
# Ensure nginx.conf is in the same directory as this Dockerfile
# ---------------------------
COPY nginx.conf /etc/nginx/nginx.conf

# ---------------------------
# Expose HTTP port
# ---------------------------
EXPOSE 80

# ---------------------------
# Default command
# Keeps Nginx running in the foreground
# Already defined in the base image, but explicit for clarity
# ---------------------------
CMD ["nginx", "-g", "daemon off;"]

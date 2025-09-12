# Usa la imagen oficial de Nginx Alpine
FROM nginx:alpine

# Copia tu configuración personalizada de Nginx
# El archivo nginx.conf debe estar en el mismo directorio que este Dockerfile
COPY nginx.conf /etc/nginx/nginx.conf

# Expone el puerto 80 para HTTP
EXPOSE 80

# Comando por defecto (ya viene en la imagen oficial)
CMD ["nginx", "-g", "daemon off;"]
